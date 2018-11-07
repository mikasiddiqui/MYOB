# MYOB IT Challenge Submission 2017

## Introduction
For this submission, our team designed a web app mobile solution for small businesses. The purpose of this app was to provide small businesses such as restaurants more accessible insights into their performance.
A majority of this project was designed in less than a week and was a prototype to showcase to the judges.

## Sentiment Analysis
The program first scraped information from the internet such as restaurant reviews as the test dataset. The training dataset was retrieved from an online corpus of restaurant reviews. Zomato has also released a more extensive corpus of restaurant reviews.
A number of different classifiers are loaded into the testnltk.py file. The technique I used for classifying the data was boosting to gain a more accurate result.
NLTK Toolkit was used to tokenize the data. Finally, the restaurant reviews are analysed and sorted into positive and negative text files based on the context of the review.

##Results
The results are then showcased using a donut graph which displays the positive and negative reviews for the month. This UI was intially designed for mobile devices.
