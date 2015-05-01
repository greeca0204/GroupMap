package Dto;

import java.util.List;
import java.util.ListIterator;

import net.sf.json.JSONArray;
import Dao.UserInfoDao;
import Model.UserInfo;

public class UserInfoToJson {
	/*����ȡ�����û���ϢListת����Json��ʽ*/
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
	
	/*��ȡ�ͻ��˷��͹������û���ϢJSON������ת����List��ʽ*/
	public List<UserInfo> Json2List(String json)
	{	 
		List<UserInfo> list;
		JSONArray jsonarray = JSONArray.fromObject(json);  
		list= (List)JSONArray.toCollection(jsonarray, UserInfo.class);  
		return list;
	}
	
	/*��UserInfoת����JSON*/
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
        
        System.out.println("��list���json��");
        String json = userInfoDao.List2Json(list);
        System.out.println(json);
       
        System.out.println("��json���list������ȡ���е����ݣ�");
        List<UserInfo> lists;
        lists = userInfoDao.Json2List(json);
        for(int i=0;i<lists.size();i++){
			UserInfo userinfo = lists.get(i);
			System.out.println("�û���Ϊ:"+userinfo.getUsername());
		} 
        
        System.out.println("��UserInfo���json��");
        System.out.println(userInfoDao.UserInfo2Json(1));
        
        System.out.println("��json���list������ȡ���е����ݣ�");
        List<UserInfo> listss;
        listss = userInfoDao.Json2List(userInfoDao.UserInfo2Json(1)); 
        for(int i=0;i<listss.size();i++){
			UserInfo userinfo = listss.get(i);
			System.out.println("�û���Ϊ:"+userinfo.getUsername());
		} 
    } 
	 */
}
