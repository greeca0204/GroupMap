package Common;

public class Const {
	/*数据库连接池设置*/
	public static final String JDBC_DRIVE = "com.mysql.jdbc.Driver";  //设置JDBC驱动
	public static final String JDBC_URL = "jdbc:mysql:///groupmap"; //设置JDBC的URL
	public static final String DB_USERNAME = "root"; //设置数据库用户名
	public static final String DB_PASSWORD = ""; //设置数据库密码
	public static final int MIN_CONN_CNT = 5; //设置数据库连接池的最小连接数
	public static final int MAX_CONN_CNT = 10; //设置数据库连接池的最大连接数 
	public static final int CONN_POLL_CNT = 1; //设置连接池个数
	
	/*心跳包设置*/
	public static final String HOST = "127.0.0.1";
	public static final int PORT = 1234;  //设置服务器端口
	public static final int PORT_HEARTBEAT = 2345;  //设置服务器端口
	public static final int IDEL_TIMEOUT = 5;  //设置超时时间
	public static final int HEARTBEAT_RATE = 2;  //设置心跳包发送的时间间隔
	public static final int BUFFER_SIZE = 1024; //设置缓冲区大小
	public static final String HEARTBEAT_REQUEST = "0x01";  //设置心跳包请求报文
	public static final String HEARTBEAT_RESPONSE = "0x02"; //设置心跳包响应报文
	
	public static final int MALE = 1;
	public static final int FAMALE = 0;
	
	public static final int OFFLINE = 0;
	public static final int ONLINE = 1;	
	public static final int INVISIBLE = 2;
	
	public static final int VALID = 1;
	public static final int INVALID = 1;
}
