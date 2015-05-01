package Dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import Common.Const;

import com.jolbox.bonecp.BoneCP;
import com.jolbox.bonecp.BoneCPConfig;

public class BaseDao {
	BoneCP connectionPool = null; 
	Connection con = null;
	
	/*�������ݿ�*/
	public Connection getCon(){
		try {                   	
			Class.forName(Const.JDBC_DRIVE);  //����JDBC����  			
            BoneCPConfig config = new BoneCPConfig();  //�������ӳ�������Ϣ               
            config.setJdbcUrl(Const.JDBC_URL);   //�������ݿ��JDBC URL              
            config.setUsername(Const.DB_USERNAME);   //�������ݿ��û���     
            config.setPassword(Const.DB_PASSWORD);  //�������ݿ�����              
            config.setMinConnectionsPerPartition(Const.MIN_CONN_CNT); //�������ݿ����ӳص���С������              
            config.setMaxConnectionsPerPartition(Const.MAX_CONN_CNT);  //�������ݿ����ӳص����������  
            config.setPartitionCount(Const.CONN_POLL_CNT);  //�������ݿ����ӳ�          
            connectionPool = new BoneCP(config);  //�����ݿ����ӳػ�ȡһ�����ݿ�����              
            con = connectionPool.getConnection(); // ��ȡconnection
            /*
            if(con!=null){
            	System.out.println("���ӳɹ�!"); 
            }
            */
		}catch (Exception e) {
			e.printStackTrace();
		}
		return con;
	}

	/*�ر����ݿ�*/
	public void closeAll(Connection con, Statement stmt, ResultSet rs){
		try {
			if(rs!=null){
				rs.close(); //�ر�ResultSet����
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			if(stmt!=null){
				stmt.close(); //�ر�Statement����
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			if(con!=null && !con.isClosed()){
				con.close();  //�ر�Connection����
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			connectionPool.shutdown();  //�ر����ݿ����ӳ�  
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}
}
