import pandas as pd
import numpy as np
from sqlalchemy import create_engine

db_url = 'sqlite:///R:/Desktop/MFLogistics/database/database.sqlite'  # Correct path for SQLite

# Create a connection to the database
engine = create_engine(db_url)

# Define your query to fetch data from the 'auth_logs' table
query = """
SELECT
    id,
    user_id,
    event,
    ip_address,
    created_at,
    updated_at
FROM auth_logs
"""  # 'auth_logs' is your table name

# Load data from the database into a pandas DataFrame
df = pd.read_sql(query, engine)

# Create a column for is_fraud with 5% chance of fraud (similar to before)
df['is_fraud'] = np.random.choice([0, 1], df.shape[0], p=[0.95, 0.05])  # 95% not fraud, 5% is fraud

# Create a column for fraud likelihood (e.g., simple probability)
df['fraud_likelihood'] = df['is_fraud'] * 100.0  # Convert is_fraud to percentage (fraud=100, non-fraud=0)

# Optionally, add some noise to the fraud likelihood to simulate real-world scenarios
noise = np.random.uniform(-2, 2, df.shape[0])  # Add noise between -2% and +2%
df['fraud_likelihood'] = np.clip(df['fraud_likelihood'] + noise, 0, 100)  # Make sure values stay between 0 and 100

# Save the DataFrame to CSV (optional, if you need to export it)
df.to_csv("fraud_data_from_auth_logs.csv", index=False)

print("Data fetched from the 'auth_logs' table and saved as fraud_data_from_auth_logs.csv.")
