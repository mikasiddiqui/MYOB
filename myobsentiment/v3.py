import mysql.connector

conn = mysql.connector.connect(user='root',password='password',host='localhost',database='test')
title = input("Please enter title: ")
sentence = "MYOB Sucks."
add_values = ("INSERT INTO corpus "
               "(sentence, title) "
               "VALUES (%(sentence)s, %(title)s)")
data_values = {'sentence': sentence,
			   'title': title}
mycursor=conn.cursor()
mycursor.execute(add_values,data_values)
mycursor.execute("SHOW TABLES")
print(mycursor.fetchall())
conn.commit()
mycursor.close()
conn.close()