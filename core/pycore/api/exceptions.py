from rest_framework.exceptions import APIException


class Error:
    def __init__(self, category, message):
        self.category = category
        self.message = message

    @property
    def json(self):
        return {
            'category': self.category,
            'message': self.message
        }

class Errors:
    def __init__(self, errors):
        self.errors = errors

    @property
    def json(self):
        json_view = list()
        for error in self.errors:
            json_view.append(error.json)
        return json_view


class GeneralException(APIException):
    def __init__(self, detail=None, code=None, errors=None):
        super(GeneralException, self).__init__(detail=detail, code=code)
        self.code = code
        self.detail = detail


class InvalidRequest(GeneralException):
    status_code = 400
