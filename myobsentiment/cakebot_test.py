import cakebot as s
import mysql.connector

conn = mysql.connector.connect(user='root',password='password',host='localhost',database='test')
cursor = conn.cursor()

query = ("SELECT sentence,title,id FROM corpus ORDER BY id DESC LIMIT 1")
cursor.execute(query)

for (sentence,title,id) in cursor:

	result = s.sentiment(sentence)
	print(result)
	sentiment_table = ("INSERT INTO sentiment_table"
					"(sentence_id,title,sentiment,confidence)"
					"VALUES (%s, %s, %s, %s)")

	data_sentiment = (id, title, result[0], result[1])
	cursor.execute(sentiment_table,data_sentiment)
	conn.commit()
cursor.close()
conn.close()