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
    	log.info("����������ͻ��˴������ӡ�");
	}

	@Override
	public void sessionOpened(IoSession session) throws Exception {
		log.info("����������ͻ������Ӵ򿪡�");		
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
    	log.info("����������ͻ������ӹرա�");
    }  
 
    @Override  
    public void messageReceived(IoSession session, Object message)  throws Exception {
    	String msg = message.toString();		
        if(msg!=null)
        {
        	String ip = session.getRemoteAddress().toString();  
            log.info("��������������:"+ip+"���ӣ������յ�������Ϊ :" + msg);
            
            //���յ��ͻ��˷�����json�������������ݿ��С�
            System.out.println("�ֻ��ͻ��˷�������Ϣ��"+msg);
            
            //�������ݿ⣬�����ݿ������ת����json����������
            List<StateInfo> list = new StateInfoDao().getAllStateInfo();            
	        StateInfoToJson stateInfoToJson = new StateInfoToJson();       	        
	        String json = stateInfoToJson.List2Json(list);
            session.write(json);
            
        } 
    }   
   
    @Override
	public void messageSent(IoSession session, Object message) throws Exception {
    	log.info("����������Ϣ���ͳɹ���");
	}

    @Override
    public void exceptionCaught(IoSession session, Throwable cause) throws Exception {
    	log.error("����������Ϣ�����쳣��", cause);
    	cause.printStackTrace();
    }

    @Override
    public void sessionIdle(IoSession session, IdleStatus status) throws Exception {
    	log.info("�������˽������״̬��");
    }
}  