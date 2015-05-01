package Test;

import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import org.apache.mina.core.service.IoHandlerAdapter;
import org.apache.mina.core.session.IdleStatus;
import org.apache.mina.core.session.IoSession;   
import org.slf4j.Logger;  
import org.slf4j.LoggerFactory; 

import Dao.StateInfoDao;
import Dao.UserInfoDao;
import Dto.StateInfoToJson;
import Dto.UserInfoToJson;
import Model.StateInfo;
import Model.UserInfo;

public class ServerHandler extends IoHandlerAdapter{  
    private final static Logger log = LoggerFactory.getLogger(ServerHandler.class);  
    
    @Override
	public void sessionCreated(IoSession session) throws Exception {
    	log.info("服务器端与客户端创建连接。");
	}

	@Override
	public void sessionOpened(IoSession session) throws Exception {
		log.info("服务器端与客户端连接打开。");		
		Timm(session);
	}
	
	public void Timm(final IoSession session)
	{
		Timer timer = new Timer();
     	timer.schedule(new TimerTask() {
		    public void run() {
		    	String json="111";
				session.write(json);
		    }
     	}, 0, 2000);
	}
	
    @Override  
    public void sessionClosed(IoSession session) throws Exception {
    	log.info("服务器端与客户端连接关闭。");
    }  
 
    @Override  
    public void messageReceived(IoSession session, Object message)  throws Exception {
    	String msg = message.toString();		
        if(msg!=null)
        {
        	String ip = session.getRemoteAddress().toString();  
            log.info("服务器端与主机:"+ip+"连接，所接收到的数据为 :" + msg);
            
            //接收到客户端发来的json，将它存入数据库中。
            System.out.println("手机客户端发来的消息："+msg);
            
            //查找数据库，将数据库的内容转化成json，并发出。
            List<StateInfo> list = new StateInfoDao().getAllStateInfo();            
	        StateInfoToJson stateInfoToJson = new StateInfoToJson();       	        
	        String json = stateInfoToJson.List2Json(list);
            session.write(json);
            
        } 
    }   
   
    @Override
	public void messageSent(IoSession session, Object message) throws Exception {
    	log.info("服务器端信息发送成功。");
	}

    @Override
    public void exceptionCaught(IoSession session, Throwable cause) throws Exception {
    	log.error("服务器端信息发送异常。", cause);
    	cause.printStackTrace();
    }

    @Override
    public void sessionIdle(IoSession session, IdleStatus status) throws Exception {
    	log.info("服务器端进入空闲状态。");
    }
}  