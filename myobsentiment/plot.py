import pylab
import mysql.connector

conn = mysql.connector.connect(user='root',password='password',host='localhost',database='test')
cursor = conn.cursor()

query = ("SELECT title,sentiment,confidence FROM sentiment_table") 

cursor.execute(query)


d1 = {}
for (title,sentiment,confidence) in cursor:

	d1.setdefault(title, []).append(sentiment)

y = [0]

for key, value in sorted(d1.items()):
	
	total = 0
	positive = 0
	negative = 0
	name = key
	print(key, value)
	for i in value:

		if i == 'pos':
			positive += 1
			total += 1
		elif i == 'neg':
			negative += 1
			total += 1
		if total == 2:
			y.append(positive/total)
			total = 0
			positive = 0
			negative = 0
	
	x = range(len(y))
	pylab.plot(x,y)
	pylab.axis([0, len(y), 0, 1.1])

	pylab.xlabel("Days")
	pylab.ylabel("Sentiment")
	pylab.savefig("graphing/"+name+".png")