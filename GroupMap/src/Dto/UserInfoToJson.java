package Dto;

import java.util.List;
import java.util.ListIterator;

import net.sf.json.JSONArray;
import Dao.UserInfoDao;
import Model.UserInfo;

public class UserInfoToJson {
	/*将获取到的用户信息List转换成Json格式*/
	public String List2Json(List<UserInfo> list)
	{	
        String str="";
		JSONArray json = new JSONArray(); 
        json.addAll(list);  
        json.listIterator();              
        if(json.isEmpty()){  
        	System.out.println("JSON does not exist!");  
        }             
        
        ListIterator  li = json.listIterator();  
        str+="[";
        while(li.hasNext()){        	
        	str+=li.next().toString(); 
        	str+=",";
        } 
        str+="]";
        return str;
	}
	
	/*读取客户端发送过来的用户信息JSON，将其转换成List格式*/
	public List<UserInfo> Json2List(String json)
	{	 
		List<UserInfo> list;
		JSONArray jsonarray = JSONArray.fromObject(json);  
		list= (List)JSONArray.toCollection(jsonarray, UserInfo.class);  
		return list;
	}
	
	/*从UserInfo转换成JSON*/
	public String UserInfo2Json(int uid)
    {				
		UserInfo userinfo = new UserInfoDao().getOneUserInfo(uid);
		JSONArray json = new JSONArray(); 
        json.add(userinfo);
        if(json.isEmpty()){  
        	System.out.println("JSON does not exist!");  
        }
        return json.toString();
    }
	
	/*
	public static void main(String[] args) {
        List<UserInfo> list = new UserInfoDao().getAllUserInfo();
        UserInfoDao userInfoDao = new UserInfoDao();       
        
        System.out.println("从list变成json：");
        String json = userInfoDao.List2Json(list);
        System.out.println(json);
       
        System.out.println("从json变成list，并获取其中的数据：");
        List<UserInfo> lists;
        lists = userInfoDao.Json2List(json);
        for(int i=0;i<lists.size();i++){
			UserInfo userinfo = lists.get(i);
			System.out.println("用户名为:"+userinfo.getUsername());
		} 
        
        System.out.println("从UserInfo变成json：");
        System.out.println(userInfoDao.UserInfo2Json(1));
        
        System.out.println("从json变成list，并获取其中的数据：");
        List<UserInfo> listss;
        listss = userInfoDao.Json2List(userInfoDao.UserInfo2Json(1)); 
        for(int i=0;i<listss.size();i++){
			UserInfo userinfo = listss.get(i);
			System.out.println("用户名为:"+userinfo.getUsername());
		} 
    } 
	 */
}
