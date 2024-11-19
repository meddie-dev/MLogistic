import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder
import joblib

# Load the fraud data (fraud_data.csv file should be in the same folder as this script)
df = pd.read_csv("fraud_data_from_auth_logs.csv")

# Prepare features (X) and target (y)
X = df.drop(columns=['id', 'created_at', 'updated_at', 'is_fraud'])  # Drop irrelevant columns
y = df['is_fraud']  # Target variable

# Initialize a LabelEncoder to convert categorical data into numeric
label_encoder = LabelEncoder()

# Encode the 'event' column (converting categorical values to numeric)
X['event'] = label_encoder.fit_transform(X['event'])

# Encode the 'ip_address' column (simple approach - use last octet of the IP address)
X['ip_address'] = X['ip_address'].apply(lambda x: int(x.split('.')[-1]))  # Last octet as a feature

# Save the Label Encoder for future use
joblib.dump(label_encoder, 'label_encoder.pkl')

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Initialize the Random Forest model
model = RandomForestClassifier()

# Train the model with the training data
model.fit(X_train, y_train)

# Save the trained model
joblib.dump(model, 'fraud_model.pkl')

# Print the model score on test data
print(f"Model Accuracy: {model.score(X_test, y_test) * 100:.2f}%")
