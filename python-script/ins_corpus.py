import pymysql

set = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "db": "nlp",
    "cursorclass": pymysql.cursors.DictCursor
}
con = pymysql.connect(**set)
c = con.cursor()

# with open("dict2.txt","r") as dict:
#     corpus = dict.readlines()
#
# for x in corpus:
#     x = x.split("\t")
#     if len(x)==2:
#         query = '''INSERT INTO temporary1(`word`,`tag`)VALUE("%s","%s")'''%(x[0],x[1])
#         # print(query)
#         c.execute(query)
#         con.commit()

c.execute("SELECT * FROM temporary1 WHERE `id`>1124")
for x in c.fetchall():
    tag = x['tag']
    tag = str(tag)
    tag = tag.replace("\n","")
    query = '''UPDATE temporary1 SET tag = "%s" WHERE `id`=%i'''%(str(tag),x['id'])
    print(query)
    c.execute(query)
    con.commit()

