import re
import sys
import json
import pickle
import math

input_data = "countries+states+cities.json"
output_data = "citiesDB"

sw = open("stopword.txt").read().split("\n")

with open(input_data, encoding='utf-8') as f:
    content = json.load(f)


# Clean string function
def clean_str(text) :
	text = (text.encode('ascii', 'ignore')).decode("utf-8")
	text = re.sub("&.*?;", "", text)
	text = re.sub(">", "", text)    
	text = re.sub("[\]\|\[\@\,\$\%\*\&\\\(\)\":]", "", text)
	text = re.sub("-", " ", text)
	text = re.sub("\.+", "", text)
	text = re.sub("^\s+","" ,text)
	text = text.lower()
	return text


df_data={}
tf_data={}
idf_data={}

i=0;
for data in content :
	for wilayah in data['states']:
		for kota in wilayah['cities']:
			tf={} 
			#clean and list word
			clean_title = clean_str(kota['name'])
			list_word = clean_title.split(" ")
			
			for word in list_word :
				if word in sw:
					continue
				
				#tf term frequency
				if word in tf :
					tf[word] += 1
				else :
					tf[word] = 1

				#df document frequency
				if word in df_data :
					df_data[word] += 1
				else :
					df_data[word] = 1

			tf_data[kota['id']] = tf


# Calculate Idf
for x in df_data :
   idf_data[x] = 1 + math.log10(len(tf_data)/df_data[x])

tf_idf = {}

for word in df_data:
	list_doc = []
	for data in content:
		for wilayah in data['states']:
			for kota in wilayah['cities']:
				tf_value = 0

				if word in tf_data[kota['id']] :
					tf_value = tf_data[kota['id']][word]

				weight = tf_value * idf_data[word]

				doc = {
					'nama_kota' : kota['name'],
					'latKota' : kota['latitude'],
					'longKota' : kota['longitude'],
					'nama_wilayah' : wilayah['name'],
					'kode_wilayah' : wilayah['state_code'],
					'tipe_wilayah' : wilayah['type'],
					'latWilayah' : wilayah['latitude'],
					'longWilayah' : wilayah['longitude'],
					'nama_negara' : data['name'],
					'bendera' : data['emoji'],
					'singkatan_negara' : data['iso2'],
					'noTelp' : data['phone_code'],
					'ibukota' : data['capital'],
					'nama_mata_uang' : data['currency_name'],
					'mata_uang' : data['currency'],
					'simbol_mata_uang' : data['currency_symbol'],
					'bahasa' : data['native'],
					'benua' : data['region'],
					'sub_benua' : data['subregion'],
					'kebangsaan' : data['nationality'],
					'latNegara' : data['latitude'],
					'longNegara' : data['longitude'],
					'zona_waktu' : data['timezones'],
					'score' : weight
				}

				if doc['score'] != 0 :
					if doc not in list_doc:
						list_doc.append(doc)
				
				
			tf_idf[word] = list_doc

# Write dictionary to file
with open(output_data, 'wb') as file:
     pickle.dump(tf_idf, file)