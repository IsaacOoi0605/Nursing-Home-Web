from prophet.serialize import model_from_json
import sys
import json
import datetime
from datetime import date
from pandas.tseries.offsets import MonthEnd
import pandas as pd

##load model
with open('C:\\xampp\\htdocs\\FYP\\model\\bed_model.json', 'r') as fin:
    m = model_from_json(fin.read())  # Load model

##get date from php
toDate=sys.argv[2]
fromDate=sys.argv[1]

#set up new month for forecast
newMonth=[]
for beg in pd.date_range(fromDate, toDate, freq='MS'):
    newMonth.append(beg.strftime("%Y-%m-%d"))

#convert into dataframe for forecast
df = pd.DataFrame(newMonth, columns=['ds'])

#forecast result
forecast=m.predict(df)
#only left date and result
newForecast=forecast[['ds','yhat']]
#convert result to numpy
Array=newForecast.to_numpy()
for i in Array:
    i[0]=i[0].strftime("%m/%d/%Y")
    i[1]=round(i[1], 2)
print(json.dumps(Array.tolist()))
