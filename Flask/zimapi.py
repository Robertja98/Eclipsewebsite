import ctypes
import platform
import os

class Zimapi:

    Zimclient = None
    hconn = ctypes.c_int()
    state = ctypes.c_int(0)

    class Zimcursor:

        # Initialize.
        def __init__(self):
            self.membercount = ctypes.c_int(0)
            self.constTop = ctypes.c_int(-2147483647)
            self.constBottom = ctypes.c_int(2147483647)
            
            Zimapi.Zimclient.APICreateCursor.restype = ctypes.c_int
            Zimapi.Zimclient.APICreateCursor.argtypes = [ctypes.c_int]
            self.setnumber = Zimapi.Zimclient.APICreateCursor(Zimapi.hconn)
            #print('APICreateCursor=' + str(self.setnumber))

        # Initialize.
        def __del__(self):
            print('destroying=' + str(self.setnumber))

        # Close the cursor.
        def close(self):
            Zimapi.Zimclient.APICloseCursor.restype = ctypes.c_int
            Zimapi.Zimclient.APICloseCursor.argtypes = [ctypes.c_int, ctypes.c_int]
            err = Zimapi.Zimclient.APICloseCursor(Zimapi.hconn, self.setnumber)
            #print('APICloseCursor=' + str(err))
            del self

        # Create a cursor by executing a database statement.
        def execute(self, statement='*'):
            Zimapi.Zimclient.APIExecuteCursor.restype = ctypes.c_int
            Zimapi.Zimclient.APIExecuteCursor.argtypes = [ctypes.c_int, ctypes.c_char_p]
            c = Zimapi.Zimclient.APIExecuteCursor(Zimapi.hconn, statement.encode(), self.setnumber)
            #print('Cursor RC=' + str(c) + ' Stmt=' + statement)

        # Get the number of rows affected by the last statement execution.
        def rowcount(self):
            Zimapi.Zimclient.APIRowCount.restype = ctypes.c_int
            Zimapi.Zimclient.APIRowCount.argtypes = [ctypes.c_int, ctypes.c_int]
            rowcount = Zimapi.Zimclient.APIRowCount(Zimapi.hconn, self.setnumber)
            return rowcount

        # Get the current row number (0-based).
        def rownumber(self):
            Zimapi.Zimclient.APIRowNumber.restype = ctypes.c_int
            Zimapi.Zimclient.APIRowNumber.argtypes = [ctypes.c_int, ctypes.c_int]
            err = Zimapi.Zimclient.APIRowNumber(Zimapi.hconn, self.setnumber)
            print('APIRowNumber=' + str(err))
            return err

        # Fetch the current row and advance the row number.
        def fetchone(self):
            Zimapi.Zimclient.APIFetchOne.restype = ctypes.c_char_p
            Zimapi.Zimclient.APIFetchOne.argtypes = [ctypes.c_int, ctypes.c_int]
            row = Zimapi.Zimclient.APIFetchOne(Zimapi.hconn, self.setnumber)           
            #print('APIFetchOne=' + str(row))
            return eval(row)

        # Scrolling a set.
        def scroll(self, value=1, mode="relative"):
            #print(type(value))
            if type(value) is str:
                if value.upper() == "TOP":
                    number = self.constTop
                elif value.upper() == "BOTTOM":
                    number = self.constBottom
                else:
                    print("Invalid set operation: either TOP, BOTTOM or a number")
                    return -1
            else:
                number = ctypes.c_int(value)
            #print(number)
            Zimapi.Zimclient.APIScrollSet.restype = ctypes.c_int
            Zimapi.Zimclient.APIScrollSet.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int]
            rc = Zimapi.Zimclient.APIScrollSet(Zimapi.hconn, self.setnumber, number)    
            #print(rc)
            return rc

        # Top of a set.
        def top(self):
            Zimapi.Zimclient.APIScrollSet.restype = ctypes.c_int
            Zimapi.Zimclient.APIScrollSet.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int]
            rc = Zimapi.Zimclient.APIScrollSet(Zimapi.hconn, self.setnumber, self.constTop)    
            return rc

        # Bottom of a set.
        def bottom(self):
            Zimapi.Zimclient.APIScrollSet.restype = ctypes.c_int
            Zimapi.Zimclient.APIScrollSet.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int]
            rc = Zimapi.Zimclient.APIScrollSet(Zimapi.hconn, self.setnumber, self.constBottom)    
            return rc

        # Next member of a set.
        def next(self, value=1):
            Zimapi.Zimclient.APIScrollSet.restype = ctypes.c_int
            Zimapi.Zimclient.APIScrollSet.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int]
            rc = Zimapi.Zimclient.APIScrollSet(Zimapi.hconn, self.setnumber, 1)    
            return rc

        # Previous member of a set.
        def previous(self, value=-1):
            Zimapi.Zimclient.APIScrollSet.restype = ctypes.c_int
            Zimapi.Zimclient.APIScrollSet.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int]
            rc = Zimapi.Zimclient.APIScrollSet(Zimapi.hconn, self.setnumber, -1)    
            return rc

    # Initialize and connect.
    def __init__(self, host="none", port=0, user="ZIM", password = "", dbname = ""):
        try:
            print("ZimAPI for Python - Version 2.15 - Connection parameters.")
            if platform.system() == "Windows":
                import winreg
                Registry = winreg.ConnectRegistry(None, winreg.HKEY_LOCAL_MACHINE)
                RawKey = winreg.OpenKey(Registry, "SOFTWARE\\Zim\\9.50")
                name, value, type = winreg.EnumValue(RawKey, 0)
                Zimapi.Zimclient = ctypes.cdll.LoadLibrary(value + "\\zimapi.dll")
            elif platform.system() == "Linux":
                ZimEnv = os.environ.get('ZIM', 'ZIM')
                print(ZimEnv)
                if ZimEnv == "ZIM":
                    print("No ZIM environment variable.")
                Zimapi.Zimclient = ctypes.cdll.LoadLibrary(ZimEnv + "/zimapi.so")
                print(Zimapi.Zimclient)
        except Exception as e:
            print('Error connecting to Zim Server: {}'.format(e))
            self.state = 9903
            
        if host != "none" or port > 0 or dbname != "":
            if host == "none":
                host = "localhost"
            if port == 0:
                port = 6002
            self.connect(host, port, user, password, dbname)

    # The connection itself.
    def connect(self, host="localhost", port=6002, user="ZIM", password = "", dbname = ""):
        Zimapi.Zimclient.APIOpen.restype = ctypes.c_int
        Zimapi.Zimclient.APIOpen.argtypes = [ctypes.POINTER(ctypes.c_int), ctypes.c_char_p, ctypes.c_char_p]
        connString = "Port=" + str(port) + ";Host=" + host + ";Password=" + password + ";User=" + user + ";DBName=" + dbname + ";";
        self.state = Zimapi.Zimclient.APIOpen(ctypes.byref(Zimapi.hconn), connString.encode(), "PYTHON".encode())
        #print('Connection RC=' + str(self.state))
        return self

    # Close the connection.
    def close(self):
        Zimapi.Zimclient.APIOpen.restype = ctypes.c_int
        Zimapi.Zimclient.APIOpen.argtypes = [ctypes.POINTER(ctypes.c_int)]
        self.state = Zimapi.Zimclient.APIClose(ctypes.byref(Zimapi.hconn))
        #print('Close the connection RC=' + str(conn))
        return self.state

    # Create a cursor in this connection.
    def cursor(self, statement="None"):
        if statement == "None":        
            return self.Zimcursor()
        else:
            cur = self.Zimcursor()
            cur.execute(statement)
            return cur
            
    # Start a transaction.
    def transaction(self):
        Zimapi.Zimclient.APIOpen.restype = ctypes.c_int
        Zimapi.Zimclient.APIOpen.argtypes = [ctypes.POINTER(ctypes.c_int)]
        self.state = Zimapi.Zimclient.APIBeginTrans(ctypes.byref(Zimapi.hconn))
        print('Begin transaction RC=' + str(self.state))
        return conn

    # Commit a transaction.
    def commit(self):
        Zimapi.Zimclient.APIOpen.restype = ctypes.c_int
        Zimapi.Zimclient.APIOpen.argtypes = [ctypes.POINTER(ctypes.c_int)]
        self.state = Zimapi.Zimclient.APIEndTrans(ctypes.byref(Zimapi.hconn))
        print('End Transaction RC=' + str(self.state))
        return conn

    # Rollback a transaction.
    def rollback(self):
        Zimapi.Zimclient.APIOpen.restype = ctypes.c_int
        Zimapi.Zimclient.APIOpen.argtypes = [ctypes.POINTER(ctypes.c_int)]
        self.state = Zimapi.Zimclient.APIQuitTrans(ctypes.byref(Zimapi.hconn))
        print('Quit transaction RC=' + str(self.state))
        return conn

    # Execute a statement.
    def execute(self, statement='*'):
        Zimapi.Zimclient.APIExecute.restype = ctypes.c_int
        Zimapi.Zimclient.APIExecute.argtypes = [ctypes.c_int, ctypes.c_char_p]
        self.state = Zimapi.Zimclient.APIExecute(Zimapi.hconn, statement.encode())
        print('Execute RC=' + str(self.state) + ' Stmt=' + statement)
        return self.state

    # The last error message.
    def lasterrormsg(self):
        Zimapi.Zimclient.APILastErrorMsg.restype = ctypes.c_char_p
        Zimapi.Zimclient.APILastErrorMsg.argtypes = [ctypes.c_int]
        err = Zimapi.Zimclient.APILastErrorMsg(Zimapi.hconn)
        print('APILastErrorMsg=' + str(err))
        return str(err)

    # The last error code.
    def lasterrorcode(self):
        Zimapi.Zimclient.APILastErrorCode.restype = ctypes.c_int
        Zimapi.Zimclient.APILastErrorCode.argtypes = [ctypes.c_int]
        code = Zimapi.Zimclient.APILastErrorCode(Zimapi.hconn)
        print('APILastErrorCode=' + str(code))
        return code

    # The last error level.
    def lasterrorlevel(self):
        Zimapi.Zimclient.APILastErrorLevel.restype = ctypes.c_int
        Zimapi.Zimclient.APILastErrorLevel.argtypes = [ctypes.c_int]
        err = Zimapi.Zimclient.APILastErrorLevel(Zimapi.hconn)
        print('APILastErrorLevel=' + str(err))
        return err

    # Call a stored procedure.
    def callproc(self, proc, parms=[]):
        #print(proc)
        #print(parms)
        number = 0
        myproc = proc + "("
        for index, value in enumerate(parms):
            if index > 0:
                myproc += ", "
            if value == "?":
                number += 1
                myproc += "@" + str(number)
            else:
                myproc += repr(str(value))
        myproc = myproc + ")"
        #print(myproc)
        Zimapi.Zimclient.APIExecuteCall.restype = ctypes.c_char_p
        Zimapi.Zimclient.APIExecuteCall.argtypes = [ctypes.c_int, ctypes.c_int, ctypes.c_int, ctypes.c_char_p]
        retparms = Zimapi.Zimclient.APIExecuteCall(Zimapi.hconn, 0, number, myproc.encode())
        ret = eval(retparms)
        #print(ret)
        final = [None]
        retIndex = 0
        finalIndex = 1
        for index, value in enumerate(parms):
            if value == "?":
                final[finalIndex] = ret[retIndex]
                retIndex += 1 
                finalIndex += 1
        return final   

    # Sends a file to the server.
    def putfile(self, sourceFile, destFile, format="/A"):
        Zimapi.Zimclient.APICopyToServer.restype = ctypes.c_char_p
        Zimapi.Zimclient.APICopyToServer.argtypes = [ctypes.c_int, ctypes.c_char_p, ctypes.c_char_p, ctypes.c_char_p]
        filecopy = Zimapi.Zimclient.APICopyToServer(Zimapi.hconn, sourceFile.encode(), destFile.encode(), format.encode())
        #print('copied file=' + str(filecopy))
        return filecopy

    # Gets a file from the server.
    def getfile(self, sourceFile, destFile, format="/A"):
        Zimapi.Zimclient.APICopyFromServer.restype = ctypes.c_char_p
        Zimapi.Zimclient.APICopyFromServer.argtypes = [ctypes.c_int, ctypes.c_char_p, ctypes.c_char_p, ctypes.c_char_p]
        filecopy = Zimapi.Zimclient.APICopyFromServer(Zimapi.hconn, sourceFile.encode(), destFile.encode(), format.encode())
        #print('gotten file=' + str(filecopy))
        return filecopy
