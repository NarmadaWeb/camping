from flask import Blueprint, render_template, request, redirect, url_for
from models.user_model import User

user_bp = Blueprint('users', __name__)

@user_bp.route('/')
def index():
    """
    Displays a list of all users.
    """
    users = User.find_all()
    return render_template('users/index.html', users=users)

@user_bp.route('/<int:user_id>')
def show(user_id):
    """
    Displays details for a single user.
    """
    user = User.find_by_id(user_id)
    if user:
        return render_template('users/detail.html', user=user)
    return "User not found", 404

@user_bp.route('/new', methods=['GET', 'POST'])
def new():
    """
    Handles creating a new user (display form and process submission).
    """
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        User.create(username, email)
        return redirect(url_for('users.index'))
    return render_template('users/new.html')

# Add some dummy users for testing
User.create("JohnDoe", "john@example.com")
User.create("JaneSmith", "jane@example.com")
