import sys
import json
import pandas as pd
import joblib
import ipaddress

# Load the trained model and label encoder
model = joblib.load('fraud_model.pkl')  # Path to your trained model
label_encoder = joblib.load('label_encoder.pkl')  # Path to your saved label encoder

# Function to convert IP address from string to numeric format (same as in training)
def ip_to_numeric(ip):
    cleaned_ip = '.'.join(str(int(octet)) for octet in ip.split('.'))
    return int(ipaddress.IPv4Address(cleaned_ip))

# Function to handle unseen events
def handle_unseen_events(event, label_encoder):
    if event in label_encoder.classes_:
        return label_encoder.transform([event])[0]
    else:
        # Handle unseen events (assigning to 'unknown' or a default)
        return label_encoder.transform(['unknown'])[0]

# Read JSON data from stdin
input_data = sys.stdin.read()
data = json.loads(input_data)

# Create a DataFrame from the input data
df = pd.DataFrame(data)

# Preprocess the data (similar to the training script)
df['event'] = df['event'].apply(lambda x: handle_unseen_events(x, label_encoder))
df['ip_address'] = df['ip_address'].apply(ip_to_numeric)

# Drop any irrelevant columns
df = df.drop(columns=['created_at', 'updated_at'], errors='ignore')

# Make predictions using the trained model
predictions = model.predict(df)
probabilities = model.predict_proba(df)  # Get probabilities for fraud likelihood

# Combine predictions with probabilities
results = []
for i in range(len(predictions)):
    results.append({
        'fraud_detected': bool(predictions[i]),
        'fraud_likelihood': round(probabilities[i][1] * 100, 2)  # Probability of fraud
    })

# Return the results as JSON
print(json.dumps(results))
