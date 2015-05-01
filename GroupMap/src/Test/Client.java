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
		// ����һ���������Ŀͻ��˳���
		IoConnector connector = new NioSocketConnector();
		// �������ӳ�ʱʱ��
		connector.setConnectTimeout(30000);
		// ��ӹ�����
		connector.getFilterChain().addLast("codec", new ProtocolCodecFilter(new TextLineCodecFactory()));  
		// ���ҵ���߼���������
		connector.setHandler(new ClientHandler());
		IoSession session = null;
		try {
			ConnectFuture future = connector.connect(new InetSocketAddress(
					HOST, PORT));// ��������
			future.awaitUninterruptibly();// �ȴ����Ӵ������
			session = future.getSession();// ���session       
	        String json = "[{'creTime':19910204,'email':'348295407@qq.com','nationNo':'China','password':'123456','sex':1,'status':1,'telAccount':'1234567890','uid':2,'username':'�޼һ�'}]";
			session.write(json);// ������Ϣ
		} catch (Exception e) {
			logger.error("�ͻ��������쳣��", e);
		}

		session.getCloseFuture().awaitUninterruptibly();// �ȴ����ӶϿ�
		connector.dispose();
	}
}

