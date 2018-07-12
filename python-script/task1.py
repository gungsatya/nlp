import sys, string, json

words = sys.argv[1]
# words = "Aku bukanlah superman aku adalah seorang kapitent yang mempunyai pedang panjang kapitent ganteng"

for char in string.punctuation:
    words = words.replace(char, ' ')

word_list = words.split()
word_freq = [word_list.count(word) for word in word_list]
dict = dict(zip(word_list, word_freq))

dict = [{"freq":dict[key],"word":key} for key in dict]
# dict.sort()
# dict.reverse()
result = {"result":dict}
print(json.dumps(result, sort_keys=True, indent=3))
