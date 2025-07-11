from flask import Flask, render_template
from controllers.user_controller import user_bp

app = Flask(__name__)

# Register blueprints
app.register_blueprint(user_bp, url_prefix='/users')

@app.route('/')
def home():
    return "Welcome to the Camping Spot Rental App! Go to /users to see user management."

if __name__ == '__main__':
    app.run(debug=True)
