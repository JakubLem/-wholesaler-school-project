from django.conf.urls import url, include
from rest_framework import routers
from . import views
from graphene_django.views import GraphQLView
from api.schema import schema


urlpatterns = [
    url(r'test/', views.GetTestViewSet.as_view(), name='test'),
    path('notes/', views.NoteViewSet, name='notes'),
    url(r'^graph/', GraphQLView.as_view(graphiql=True, schema=schema)),
]
