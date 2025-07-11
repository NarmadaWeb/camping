class User:
    """
    A simple User model. In a real application, this would interact with a database.
    """
    _users = {}  # A simple in-memory store for demonstration

    def __init__(self, user_id, username, email):
        self.user_id = user_id
        self.username = username
        self.email = email

    @classmethod
    def create(cls, username, email):
        user_id = len(cls._users) + 1
        new_user = cls(user_id, username, email)
        cls._users[user_id] = new_user
        return new_user

    @classmethod
    def find_all(cls):
        return list(cls._users.values())

    @classmethod
    def find_by_id(cls, user_id):
        return cls._users.get(user_id)

    def to_dict(self):
        return {
            "user_id": self.user_id,
            "username": self.username,
            "email": self.email
        }
