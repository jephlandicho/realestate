import pandas as pd
import pickle
import json
import sys

# load the pre-trained model
with open('realestate.pkl', 'rb') as f:
    model = pickle.load(f)

# read input data from command line argument
input_data = json.loads(sys.argv[1])

# convert the input data to a Pandas dataframe
df = pd.DataFrame(input_data, index=[0])
df['feature1'] = df['feature1'].astype(float)
df['feature2'] = df['feature2'].astype(float)
df['feature3'] = df['feature3'].astype(float)
df['feature4'] = df['feature4'].astype(float)
df['feature5'] = df['feature5'].astype(float)

# make the prediction using the pre-trained model
prediction = model.predict(df)[0]

# output the prediction as a JSON string
output_data = {'prediction': prediction}
print(json.dumps(output_data))
