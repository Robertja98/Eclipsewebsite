from flask import Flask, render_template, request
import zimapi

app = Flask(__name__)

def get_zim_connection():
    zim = zimapi.Zimapi()
    zim = zim.connect(
        dbname="your_database_name",
        host="localhost",
        port=6002,
        user="ZIM",
        password=""
    )
    return zim

@app.route('/', methods=['GET', 'POST'])
def index():
    result = ""
    if request.method == 'POST':
        cust_code = request.form['cust_code']
        zim = get_zim_connection()
        query = f'DELETE 1 Customers WHERE CustCode = {cust_code}'
        if zim.execute(query) == 0:
            result = "Executed successfully."
        else:
            result = f"Error executing statement. Error Code = {zim.state}"
        zim.close()
    return render_template('index.html', result=result)

if __name__ == '__main__':
    app.run(debug=True)