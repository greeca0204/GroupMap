package Test;

import java.awt.BorderLayout;
import java.awt.Frame;
import java.awt.TextArea;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent; 
import java.net.InetSocketAddress;  
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.ExecutorService;

import org.apache.mina.core.service.IoAcceptor;  
import org.apache.mina.core.service.IoHandler;
import org.apache.mina.core.session.IdleStatus;  
import org.apache.mina.core.session.IoSession;  
import org.apache.mina.filter.codec.ProtocolCodecFilter;  
import org.apache.mina.filter.codec.textline.TextLineCodecFactory;
import org.apache.mina.filter.executor.ExecutorFilter;
import org.apache.mina.filter.executor.OrderedThreadPoolExecutor;
import org.apache.mina.filter.keepalive.KeepAliveFilter;  
import org.apache.mina.filter.keepalive.KeepAliveMessageFactory;  
import org.apache.mina.filter.keepalive.KeepAliveRequestTimeoutHandler;
import org.apache.mina.filter.logging.LoggingFilter;  
import org.apache.mina.transport.socket.SocketAcceptor;
import org.apache.mina.transport.socket.nio.NioSocketAcceptor;  
import org.slf4j.Logger;  
import org.slf4j.LoggerFactory;  

import Common.Const;

public class Server extends Frame
{
	private static final Logger LOG = LoggerFactory.getLogger(Server.class);
	//static TextArea ta = new TextArea();
	/*���췽��*/
	public Server()
	{
		//launchFrame();
	}
	
	/*�������������*/
	/*
	public void launchFrame()
	{
		add(ta, BorderLayout.CENTER);
		setBounds(0,0,500,500);	
		this.addWindowListener(
			new WindowAdapter() 
			{
				public void windowClosing(WindowEvent e)
				{
					System.exit(0);
				}
			}
		);
		setVisible(true);
	}
	*/
	
	/*���س���*/
	public void startServer() throws Exception
	{
		IoAcceptor acceptor = new NioSocketAcceptor();  		
        acceptor.getSessionConfig().setReadBufferSize(Const.BUFFER_SIZE); //���û�������С 
        acceptor.getSessionConfig().setIdleTime(IdleStatus.BOTH_IDLE,Const.IDEL_TIMEOUT);  //���ó�ʱʱ��
        acceptor.getFilterChain().addLast("logger", new LoggingFilter());  //����LOG4Jʵ�ּ�¼��־�ļ�  
        acceptor.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
        acceptor.setHandler(new ServerHandler());        
        acceptor.bind(new InetSocketAddress(Const.PORT)); 
        
        IoAcceptor acceptor2 = new NioSocketAcceptor(); 
        acceptor2.getSessionConfig().setReadBufferSize(Const.BUFFER_SIZE); //���û�������С 
        //acceptor2.getSessionConfig().setIdleTime(IdleStatus.BOTH_IDLE,Const.IDEL_TIMEOUT);  //���ó�ʱʱ��
        acceptor2.getFilterChain().addLast("logger", new LoggingFilter());  //����LOG4Jʵ�ּ�¼��־�ļ�  
        acceptor2.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
            
        KeepAliveMessageFactory heartBeatFactory = new KeepAliveMessageFactoryImpl();  
        //����ע�͵������Զ���Handler��ʽ  
        KeepAliveRequestTimeoutHandler heartBeatHandler = new KeepAliveRequestTimeoutHandlerImpl();  
        KeepAliveFilter heartBeat = new KeepAliveFilter(heartBeatFactory, IdleStatus.BOTH_IDLE, heartBeatHandler);   
  
        //�����Ƿ�forward����һ��filter  
        heartBeat.setForwardEvent(true);     
        heartBeat.setRequestInterval(Const.HEARTBEAT_RATE);  //��������Ƶ��    
        heartBeat.setRequestTimeout(Const.IDEL_TIMEOUT);
        acceptor2.getFilterChain().addLast("heartbeat", heartBeat); 
        acceptor2.setHandler(new HeartBeatServerHandler());     
        acceptor2.bind(new InetSocketAddress(Const.PORT_HEARTBEAT)); 
        
        LOG.info("�����������˿�Ϊ��" + Const.PORT + "��" + Const.PORT_HEARTBEAT); 
        //ta.append("�����������˿�Ϊ�� " + Const.PORT+"\n");  
        //ta.append("�����������˿�Ϊ�� " + Const.PORT_HEARTBEAT+"\n");  
        
	}

	/*������*/
	public static void main(String[] args) throws Exception {  
    	Server cs = new Server();
		cs.startServer();		
    }
	
    /** 
     * @ClassName KeepAliveMessageFactoryImpl 
     * @Description �ڲ��࣬ʵ��KeepAliveMessageFactory������������ 
     * @author �޼һ� 
     * 
     */  
    public class KeepAliveMessageFactoryImpl implements KeepAliveMessageFactory {  
          
        //������������Ϣ
    	@Override
        public boolean isRequest(IoSession session, Object message) {  
        	LOG.info("������������Ϣ: " + message); 
        	//ta.append("������������Ϣ: " + message+"\n");
        	if (message.equals(Const.HEARTBEAT_REQUEST)) { 
                return true;  
            }
            return false;  
        }  
  
        //��Ӧ��������Ϣ
        @Override         
        public boolean isResponse(IoSession session, Object message) {  
        	LOG.info("��Ӧ��������Ϣ: " + message); 
        	//ta.append("��Ӧ��������Ϣ: " + message+"\n");
        	if(message.equals(Const.HEARTBEAT_RESPONSE)){
        		return true;  
        	}
            return false;  
        }  
  
        //����Ԥ����Ϣ
        @Override  
        public Object getRequest(IoSession session) {  
        	LOG.info("����Ԥ����Ϣ: " + Const.HEARTBEAT_REQUEST);  
        	//ta.append("����Ԥ����Ϣ: " + Const.HEARTBEAT_REQUEST+"\n");
            /** ����Ԥ����� */  
            return Const.HEARTBEAT_REQUEST;  
        }  
  
        //��ӦԤ����Ϣ
        @Override  
        public Object getResponse(IoSession session, Object request) {  
            LOG.info("��ӦԤ����Ϣ: " + Const.HEARTBEAT_RESPONSE); 
            //ta.append("��ӦԤ����Ϣ: " + Const.HEARTBEAT_RESPONSE+"\n");
            /** ����Ԥ����� */  
            return Const.HEARTBEAT_RESPONSE;  
        }  
    }  
      
    /** 
     * KeepAliveFilter(heartBeatFactory,IdleStatus.BOTH_IDLE,heartBeatHandler)  
     * ������ʱ���� 
     * KeepAliveFilter ��û���յ�������Ϣ����Ӧʱ���ᱨ�����KeepAliveRequestTimeoutHandler�� 
     * Ĭ�ϵĴ����� KeepAliveRequestTimeoutHandler.CLOSE 
     * �����������handler���������ʹ��Ĭ�ϵĴӶ�Close���Session�� 
     * @author �޼һ� 
     * 
     */  
	private static class KeepAliveRequestTimeoutHandlerImpl implements KeepAliveRequestTimeoutHandler {  
		public void keepAliveRequestTimedOut(KeepAliveFilter filter, IoSession session) throws Exception {  
			Server.LOG.info("������ʱ��");  
			//ta.append("������ʱ��\n"); 
		}    
	}  	

} 

