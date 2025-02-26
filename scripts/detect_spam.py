import sys
import joblib

# Load model and vectorizer
model = joblib.load('spam_detector.pkl')
vectorizer = joblib.load('vectorizer.pkl')

# Predict
text = [sys.argv[1]]
text_vectorized = vectorizer.transform(text)
prediction = model.predict(text_vectorized)
print("Spam" if prediction[0] == 1 else "Not Spam")