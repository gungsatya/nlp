
with open("corpus1.txt",'r') as rawcorpus:
    corpus = rawcorpus.readlines()
with open("dict1.txt",'w') as dict:
    for x in corpus:
        x = x.split("\t")
        x = x[1]
        x = x.split()
        if(len(x)==2):
            dict.write(x[1]+"/"+x[0]+"\n")