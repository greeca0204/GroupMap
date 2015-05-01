package Dto;

import java.util.List;
import java.util.ListIterator;

import net.sf.json.JSONArray;
import Model.StateInfo;

public class StateInfoToJson {
	/*将获取到的用户信息List转换成Json格式*/
	public String List2Json(List<StateInfo> list)
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
	public List<StateInfo> Json2List(String json)
	{	 
		List<StateInfo> list;
		JSONArray jsonarray = JSONArray.fromObject(json);  
		list= (List)JSONArray.toCollection(jsonarray, StateInfo.class);  
		return list;
	}
}
