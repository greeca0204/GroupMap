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
	/*构造方法*/
	public Server()
	{
		//launchFrame();
	}
	
	/*服务器程序界面*/
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
	
	/*主控程序*/
	public void startServer() throws Exception
	{
		IoAcceptor acceptor = new NioSocketAcceptor();  		
        acceptor.getSessionConfig().setReadBufferSize(Const.BUFFER_SIZE); //设置缓冲区大小 
        acceptor.getSessionConfig().setIdleTime(IdleStatus.BOTH_IDLE,Const.IDEL_TIMEOUT);  //设置超时时间
        acceptor.getFilterChain().addLast("logger", new LoggingFilter());  //加入LOG4J实现记录日志文件  
        acceptor.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
        acceptor.setHandler(new ServerHandler());        
        acceptor.bind(new InetSocketAddress(Const.PORT)); 
        
        IoAcceptor acceptor2 = new NioSocketAcceptor(); 
        acceptor2.getSessionConfig().setReadBufferSize(Const.BUFFER_SIZE); //设置缓冲区大小 
        //acceptor2.getSessionConfig().setIdleTime(IdleStatus.BOTH_IDLE,Const.IDEL_TIMEOUT);  //设置超时时间
        acceptor2.getFilterChain().addLast("logger", new LoggingFilter());  //加入LOG4J实现记录日志文件  
        acceptor2.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
            
        KeepAliveMessageFactory heartBeatFactory = new KeepAliveMessageFactoryImpl();  
        //下面注释掉的是自定义Handler方式  
        KeepAliveRequestTimeoutHandler heartBeatHandler = new KeepAliveRequestTimeoutHandlerImpl();  
        KeepAliveFilter heartBeat = new KeepAliveFilter(heartBeatFactory, IdleStatus.BOTH_IDLE, heartBeatHandler);   
  
        //设置是否forward到下一个filter  
        heartBeat.setForwardEvent(true);     
        heartBeat.setRequestInterval(Const.HEARTBEAT_RATE);  //设置心跳频率    
        heartBeat.setRequestTimeout(Const.IDEL_TIMEOUT);
        acceptor2.getFilterChain().addLast("heartbeat", heartBeat); 
        acceptor2.setHandler(new HeartBeatServerHandler());     
        acceptor2.bind(new InetSocketAddress(Const.PORT_HEARTBEAT)); 
        
        LOG.info("服务器开启端口为：" + Const.PORT + "和" + Const.PORT_HEARTBEAT); 
        //ta.append("服务器开启端口为： " + Const.PORT+"\n");  
        //ta.append("服务器开启端口为： " + Const.PORT_HEARTBEAT+"\n");  
        
	}

	/*主程序*/
	public static void main(String[] args) throws Exception {  
    	Server cs = new Server();
		cs.startServer();		
    }
	
    /** 
     * @ClassName KeepAliveMessageFactoryImpl 
     * @Description 内部类，实现KeepAliveMessageFactory（心跳工厂） 
     * @author 罗家辉 
     * 
     */  
    public class KeepAliveMessageFactoryImpl implements KeepAliveMessageFactory {  
          
        //请求心跳包信息
    	@Override
        public boolean isRequest(IoSession session, Object message) {  
        	LOG.info("请求心跳包信息: " + message); 
        	//ta.append("请求心跳包信息: " + message+"\n");
        	if (message.equals(Const.HEARTBEAT_REQUEST)) { 
                return true;  
            }
            return false;  
        }  
  
        //响应心跳包信息
        @Override         
        public boolean isResponse(IoSession session, Object message) {  
        	LOG.info("响应心跳包信息: " + message); 
        	//ta.append("响应心跳包信息: " + message+"\n");
        	if(message.equals(Const.HEARTBEAT_RESPONSE)){
        		return true;  
        	}
            return false;  
        }  
  
        //请求预设信息
        @Override  
        public Object getRequest(IoSession session) {  
        	LOG.info("请求预设信息: " + Const.HEARTBEAT_REQUEST);  
        	//ta.append("请求预设信息: " + Const.HEARTBEAT_REQUEST+"\n");
            /** 返回预设语句 */  
            return Const.HEARTBEAT_REQUEST;  
        }  
  
        //响应预设信息
        @Override  
        public Object getResponse(IoSession session, Object request) {  
            LOG.info("响应预设信息: " + Const.HEARTBEAT_RESPONSE); 
            //ta.append("响应预设信息: " + Const.HEARTBEAT_RESPONSE+"\n");
            /** 返回预设语句 */  
            return Const.HEARTBEAT_RESPONSE;  
        }  
    }  
      
    /** 
     * KeepAliveFilter(heartBeatFactory,IdleStatus.BOTH_IDLE,heartBeatHandler)  
     * 心跳超时处理 
     * KeepAliveFilter 在没有收到心跳消息的响应时，会报告给的KeepAliveRequestTimeoutHandler。 
     * 默认的处理是 KeepAliveRequestTimeoutHandler.CLOSE 
     * （即如果不给handler参数，则会使用默认的从而Close这个Session） 
     * @author 罗家辉 
     * 
     */  
	private static class KeepAliveRequestTimeoutHandlerImpl implements KeepAliveRequestTimeoutHandler {  
		public void keepAliveRequestTimedOut(KeepAliveFilter filter, IoSession session) throws Exception {  
			Server.LOG.info("心跳超时！");  
			//ta.append("心跳超时！\n"); 
		}    
	}  	

} 

