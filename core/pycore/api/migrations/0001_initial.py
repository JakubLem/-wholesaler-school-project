# Generated by Django 3.0.7 on 2021-02-22 16:44

import api.models
from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Company',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('identifier', models.CharField(default=api.models.ownrandomstring, max_length=150)),
                ('nip', models.CharField(max_length=13)),
                ('fullname', models.CharField(max_length=150)),
            ],
        ),
    ]
