package Common;

public class Const {
	/*���ݿ����ӳ�����*/
	public static final String JDBC_DRIVE = "com.mysql.jdbc.Driver";  //����JDBC����
	public static final String JDBC_URL = "jdbc:mysql:///groupmap"; //����JDBC��URL
	public static final String DB_USERNAME = "root"; //�������ݿ��û���
	public static final String DB_PASSWORD = ""; //�������ݿ�����
	public static final int MIN_CONN_CNT = 5; //�������ݿ����ӳص���С������
	public static final int MAX_CONN_CNT = 10; //�������ݿ����ӳص���������� 
	public static final int CONN_POLL_CNT = 1; //�������ӳظ���
	
	/*����������*/
	public static final String HOST = "127.0.0.1";
	public static final int PORT = 1234;  //���÷������˿�
	public static final int PORT_HEARTBEAT = 2345;  //���÷������˿�
	public static final int IDEL_TIMEOUT = 5;  //���ó�ʱʱ��
	public static final int HEARTBEAT_RATE = 2;  //�������������͵�ʱ����
	public static final int BUFFER_SIZE = 1024; //���û�������С
	public static final String HEARTBEAT_REQUEST = "0x01";  //����������������
	public static final String HEARTBEAT_RESPONSE = "0x02"; //������������Ӧ����
	
	public static final int MALE = 1;
	public static final int FAMALE = 0;
	
	public static final int OFFLINE = 0;
	public static final int ONLINE = 1;	
	public static final int INVISIBLE = 2;
	
	public static final int VALID = 1;
	public static final int INVALID = 1;
}
