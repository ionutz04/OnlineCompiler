FROM python:3

WORKDIR /home/ionutz/apache/app/upload
RUN pip install --upgrade pip
#COPY /home/ionutz/apache/app/upload/requirements.txt ./
COPY requirements.txt ./
RUN pip install --no-cache-dir -r requirements.txt
