package Test;

import java.net.InetSocketAddress;
import org.apache.log4j.Logger;
import org.apache.mina.core.future.ConnectFuture;
import org.apache.mina.core.service.IoConnector;
import org.apache.mina.core.session.IoSession;
import org.apache.mina.filter.codec.ProtocolCodecFilter;
import org.apache.mina.filter.codec.textline.TextLineCodecFactory;
import org.apache.mina.transport.socket.nio.NioSocketConnector;

public class Client {
	private static Logger logger = Logger.getLogger(Client.class);

	private static String HOST = "127.0.0.1";

	private static int PORT = 1234;

	public static void main(String[] args) {       
		// 创建一个非阻塞的客户端程序
		IoConnector connector = new NioSocketConnector();
		// 设置链接超时时间
		connector.setConnectTimeout(30000);
		// 添加过滤器
		connector.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
		// 添加业务逻辑处理器类
		connector.setHandler(new ClientHandler());
		IoSession session = null;
		try {
			ConnectFuture future = connector.connect(new InetSocketAddress(
					HOST, PORT));// 创建连接
			future.awaitUninterruptibly();// 等待连接创建完成
			session = future.getSession();// 获得session       
	        String json = "[{'creTime':19910204,'email':'348295407@qq.com','nationNo':'China','password':'123456','sex':1,'status':1,'telAccount':'1234567890','uid':2,'username':'罗家辉'}]";
			session.write(json);// 发送消息
		} catch (Exception e) {
			logger.error("客户端链接异常。", e);
		}

		session.getCloseFuture().awaitUninterruptibly();// 等待连接断开
		connector.dispose();
	}
}

