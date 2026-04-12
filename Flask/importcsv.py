import csv

def read_csv(filename):
    with open(filename, newline='') as f:
        reader = csv.DictReader(f)
        return list(reader)