<%@ WebHandler Language="C#" Class="getuserinfo" %>


using System.Web;
using System.Collections.Generic;
using System.Web.Script.Serialization;
using System.Data;
using LangChao.ECGAP.DAL;
using System.Web.SessionState;



public class getuserinfo : IHttpHandler,IRequiresSessionState {

    public void ProcessRequest(HttpContext context)
    {
        getdata(context);
    }
    public void getdata(HttpContext context)
    {
        context.Response.ContentType = "application/json";
        List<youke> tlist = new List<youke>();
        string sql = "select * from out_user_tab where userName = '"+context.Session["username"].ToString()+"'";
        DataSet ds = cSqlHelper.ExecuteDataset(DBCon.constr, CommandType.Text, sql);
        foreach (DataRow dr in ds.Tables[0].Rows)
        {
            youke xy = new youke();
            xy.Userid=int.Parse(dr["userId"].ToString());

          
                xy.Username = dr["userName"].ToString();
                xy.Selfshow = dr["selfshow"].ToString();
                xy.Picurl = dr["selfpic"].ToString();
                xy.Dengji = int.Parse(dr["dengji"].ToString());
                xy.Fuwutype = dr["fuwutype"].ToString();
                xy.Haoping = int.Parse(dr["haoping"].ToString())/(int.Parse(dr["haoping"].ToString())+int.Parse(dr["chaping"].ToString()));
                tlist.Add(xy);
           
        }
        JavaScriptSerializer Serializer = new JavaScriptSerializer();
        string JSONstr = Serializer.Serialize(tlist);
        context.Response.Write(JSONstr);
    }
    public bool IsReusable {
        get {
            return false;
        }
    }

}