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
	
	/*连接数据库*/
	public Connection getCon(){
		try {                   	
			Class.forName(Const.JDBC_DRIVE);  //加载JDBC驱动  			
            BoneCPConfig config = new BoneCPConfig();  //设置连接池配置信息               
            config.setJdbcUrl(Const.JDBC_URL);   //设置数据库的JDBC URL              
            config.setUsername(Const.DB_USERNAME);   //设置数据库用户名     
            config.setPassword(Const.DB_PASSWORD);  //设置数据库密码              
            config.setMinConnectionsPerPartition(Const.MIN_CONN_CNT); //设置数据库连接池的最小连接数              
            config.setMaxConnectionsPerPartition(Const.MAX_CONN_CNT);  //设置数据库连接池的最大连接数  
            config.setPartitionCount(Const.CONN_POLL_CNT);  //设置数据库连接池          
            connectionPool = new BoneCP(config);  //从数据库连接池获取一个数据库连接              
            con = connectionPool.getConnection(); // 获取connection
            /*
            if(con!=null){
            	System.out.println("连接成功!"); 
            }
            */
		}catch (Exception e) {
			e.printStackTrace();
		}
		return con;
	}

	/*关闭数据库*/
	public void closeAll(Connection con, Statement stmt, ResultSet rs){
		try {
			if(rs!=null){
				rs.close(); //关闭ResultSet对象
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			if(stmt!=null){
				stmt.close(); //关闭Statement对象
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			if(con!=null && !con.isClosed()){
				con.close();  //关闭Connection对象
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		try {
			connectionPool.shutdown();  //关闭数据库连接池  
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}
}
