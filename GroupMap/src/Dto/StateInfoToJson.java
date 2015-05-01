package Dto;

import java.util.List;
import java.util.ListIterator;

import net.sf.json.JSONArray;
import Model.StateInfo;

public class StateInfoToJson {
	/*����ȡ�����û���ϢListת����Json��ʽ*/
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
	
	/*��ȡ�ͻ��˷��͹������û���ϢJSON������ת����List��ʽ*/
	public List<StateInfo> Json2List(String json)
	{	 
		List<StateInfo> list;
		JSONArray jsonarray = JSONArray.fromObject(json);  
		list= (List)JSONArray.toCollection(jsonarray, StateInfo.class);  
		return list;
	}
}
