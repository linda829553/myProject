<%@ WebHandler Language="C#" Class="publishplan" %>

using System;
using System.Web;
using LangChao.ECGAP.DAL;
using System.Data;
using LangChao.ECGAP.Common;
using System.Web.SessionState;
public class publishplan : IHttpHandler,IRequiresSessionState {

    public void ProcessRequest (HttpContext context) {
        context.Response.ContentType = "text/plain";
      //  savedata(context);
       // context.Response.Write("Hello World");


         string username = context.Session["username"].ToString();
        // lvplan lvtime lvche  lvlive
        string lvplan = context.Request.Form["lvplan"].ToString();
        string lvtime = context.Request.Form["lvtime"].ToString();
        string lvche = context.Request.Form["lvche"].ToString();
        string lvlive = context.Request.Form["lvlive"].ToString();
        string yusuan = context.Request.Form["yusuan"].ToString();
        string update = "insert into lvyouxuqiu_tab (username,lvxuqiu,lvtime,lvche,lvlive,fabutime,yusuan) values (@username,@lvxuqiu,@lvtime,@lvche,@lvlive,@fabutime,@yusuan)";
        IDbDataParameter[] sp = { cSqlHelper.NewSqlParameter("@username",username),cSqlHelper.NewSqlParameter("@lvxuqiu", lvplan), cSqlHelper.NewSqlParameter("@lvtime", lvtime), cSqlHelper.NewSqlParameter("@lvche", lvche), cSqlHelper.NewSqlParameter("@lvlive", lvlive), cSqlHelper.NewSqlParameter("@fabutime", DateTime.Now.ToString("yyyy年MM月dd日")),cSqlHelper.NewSqlParameter("@yusuan", yusuan)};
        cSqlHelper.ExecuteNonQuery(DBCon.constr, CommandType.Text, update,sp);
        context.Response.Write("1");
        context.Response.End();
   
    }

    /// <summary>
    /// 将需求存入数据库
    /// </summary>
    public void savedata(HttpContext context)
    {
        }



    public bool IsReusable {
        get {
            return false;
        }
    }

}