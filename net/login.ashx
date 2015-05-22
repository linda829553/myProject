<%@ WebHandler Language="C#" Class="login" %>

using System;
using System.Web;
using System.Collections.Generic;
using System.Data;
using LangChao.ECGAP.DAL;
using LangChao.ECGAP.Common;
using System.Web.SessionState;

public class login : IHttpHandler,IRequiresSessionState {

    public void ProcessRequest (HttpContext context) {
        context.Response.ContentType = "text/plain";
        string username = context.Request.Form["username"].ToString();
        string password = context.Request.Form["password"].ToString();
        string sql = "select * from out_user_tab where userName ='"+username+"' and password = '"+password+"'";
        try
        {
            DataSet ds = cSqlHelper.ExecuteDataset(DBCon.constr, CommandType.Text, sql);
            if (ds.Tables[0].Rows.Count > 0)
            {
                context.Session["username"] = username;
                context.Response.Write("1");//1代表登录成功；2代表登录不成功
                //test
            //  cSqlHelper.ExecuteNonQuery(DBCon.constr, CommandType.Text, "update out_user_tab set qq = 001 where userName = '" + username + "'");
            }
            else { context.Response.Write("2"); }
        }
        catch(Exception  err)
        {
            throw err;
        }
    }

    public bool IsReusable {
        get {
            return false;
        }
    }

}