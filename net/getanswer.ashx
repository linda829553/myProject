<%@ WebHandler Language="C#" Class="getanswer" %>

using System;
using System.Web;
using System.IO;
using System.Web.SessionState;
using LangChao.ECGAP.DAL;
using System.Data;
using System.Xml;
using System.Text;
using System.Web.Script.Serialization;
using System.Collections.Generic;
public class getanswer : IHttpHandler,IRequiresSessionState {

    public void ProcessRequest (HttpContext context) {
        context.Response.ContentType = "application/json";
        List<huifu> tlist = new List<huifu>();
        string sql = "select * from lvyouxuqiu_tab ORDER BY Id DESC";
        DataSet ds = cSqlHelper.ExecuteDataset(DBCon.constr, CommandType.Text, sql);

        foreach (DataRow dr in ds.Tables[0].Rows)
        {
            xuyao xy = new xuyao();
            xy.Id=int.Parse(dr["Id"].ToString());

            //if (checkhuifu((xy.Id).ToString(),context) == false)
            //{
            xy.UserName = dr["userName"].ToString();
            xy.Lvche = dr["lvche"].ToString();
            xy.Lvplace = dr["lvplace"].ToString();
            xy.Lvlive = dr["lvlive"].ToString();
            xy.Lvxuqiu = dr["lvxuqiu"].ToString();
            xy.Fabutime = dr["fabutime"].ToString();
            xy.Lvtime = dr["lvtime"].ToString();
            tlist.Add(xy);
            //}
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