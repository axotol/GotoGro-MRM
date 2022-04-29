import mysql.connector

mydb = mysql.connector.connect(
  host="grotle-db.cagkrosgpaxf.us-west-1.rds.amazonaws.com",
  user="admin",
  password="8nYjnO4VZCgLBURyZ0Yv"
)

mycursor = mydb.cursor()

mycursor.execute("CREATE DATABASE mydatabase")