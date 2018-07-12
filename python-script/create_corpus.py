with open("corpus.txt",'r') as rawcorpus:
    corpus = rawcorpus.read()

corpus = corpus.replace("\n", " ")
corpus = corpus.lower()
corpus = corpus.split()
corpus = list(set(corpus))
for x in corpus:
    print(x)
