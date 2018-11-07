import nltk
import random 
from nltk.classify.scikitlearn import SklearnClassifier
import pickle

from sklearn.naive_bayes import MultinomialNB, GaussianNB, BernoulliNB #7 different algorithms
from sklearn.linear_model import LogisticRegression, SGDClassifier
from sklearn.svm import SVC, LinearSVC, NuSVC
from nltk.classify import ClassifierI
from statistics import mode

from nltk.tokenize import word_tokenize

class VoteClassifier(ClassifierI):
	def __init__(self, *classifiers):
		self._classifiers = classifiers
		
	def classify(self, features):
		votes = []
		for c in self._classifiers:
			v = c.classify(features)
			votes.append(v)
		return mode(votes) #return most votes
	
	def confidence(self, features):
		votes = []
		for c in self._classifiers:
			v = c.classify(features)
			votes.append(v)

		choice_votes = votes.count(mode(votes))
		conf = choice_votes / len(votes)
		return conf

documents_f = open("pickles/documents.pickle", "rb")
documents = pickle.load(documents_f)
documents_f.close()

word_features_over9k_f = open("pickles/word_features_over9k.pickle", "rb")
word_features = pickle.load(word_features_over9k_f)
word_features_over9k_f.close()

def find_features(document):
	words = word_tokenize(document)
	features = {}
	for w in word_features:
		features[w] = (w in words)
	return features

featuresets_f = open("pickles/featuresets.pickle", "rb")
featuresets = pickle.load(featuresets_f)
featuresets_f.close()	

random.shuffle(featuresets)

#positive data example:
training_set = featuresets[:10000]
testing_set =  featuresets[10000:]

#Loading the 7 pickled classifiers
open_file = open("pickles/orig_classifier.pickle", "rb")
classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/MNB_classifier.pickle", "rb")
MNB_classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/BernoulliNB_classifier.pickle", "rb")
BernoulliNB_classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/LogisticRegression_classifier.pickle", "rb")
LogisticRegression_classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/SGDClassifier_classifier.pickle", "rb")
SGDClassifier_classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/LinearSVC_classifier.pickle", "rb")
LinearSVC_classifier = pickle.load(open_file)
open_file.close()

open_file = open("pickles/NuSVC_classifier.pickle", "rb")
NuSVC_classifier = pickle.load(open_file)
open_file.close()

voted_classifier = VoteClassifier(classifier,MNB_classifier,BernoulliNB_classifier,LogisticRegression_classifier,SGDClassifier_classifier,LinearSVC_classifier,NuSVC_classifier)


def sentiment(text):
	feats = find_features(text)
	return voted_classifier.classify(feats), voted_classifier.confidence(feats)
	
	