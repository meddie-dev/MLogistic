from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/detect-fraud', methods=['POST'])
def detect_fraud():
    # Get data from the request
    data = request.json
    
    # Validate required fields
    if not data or 'user_id' not in data or 'event' not in data or 'ip_address' not in data:
        return jsonify({"error": "Missing required fields"}), 400
    
    user_id = data.get('user_id')
    event = data.get('event')
    ip_address = data.get('ip_address')
    
    # Example fraud detection logic
    fraud_detected = False
    
    # Simulated logic: If event is 'suspicious_event', mark as fraud
    if event == 'suspicious_event':
        fraud_detected = True
    
    # You can add more complex logic here (e.g., checking the IP address, user history, etc.)

    # Prepare prediction result
    prediction = {
        "fraud_detected": fraud_detected,
        "user_id": user_id,
        "event": event,
        "ip_address": ip_address,
        "message": "Fraud detected!" if fraud_detected else "No fraud detected."
    }
    
    # Return the result as a JSON response
    return jsonify(prediction)

if __name__ == '__main__':
    app.run(debug=True)
