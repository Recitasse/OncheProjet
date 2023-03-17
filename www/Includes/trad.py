import json
import requests
import sys

def emondage(text):
  indD = text.find('<div class="translate-container ng-star-inserted">')
  if indD != -1:
     text = text[indD:]
     
  indF = text.find('<section class="translate-similar translate-divider ng-star-inserted">')
  if indF != -1:
     text = text[:indF]
     
  return text

url = "https://app.glosbe.com/"+str(sys.argv[1])+"/fr/"+str(sys.argv[2])

# Réponse du site

reponse = requests.get(url)

# Réponse 200 si la requete http est réussie
if reponse.status_code == 200:
   html = reponse.text
   print(emondage(html))
   
   
else:
   print("Erreur")
