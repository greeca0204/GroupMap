package Dao;
import java.sql.*;
import Model.LogInfo;

public class LogInfoDao extends BaseDao {	
	/*插入日志信息*/
	public int InsertLogInfo(LogInfo logInfo)
	{		
		Connection con = null;
		PreparedStatement pstmt = null;
		int rs = 0;
		try {
			con = getCon();
			String sql = "insert into loginfo(uid,actionTime,action,data) value(?,?,?,?)";	
			pstmt = con.prepareStatement(sql);
			pstmt.setInt(1, logInfo.getUid());
			pstmt.setInt(2, logInfo.getTime());
			pstmt.setString(3, logInfo.getAction());
			pstmt.setString(4, logInfo.getData());
			rs = pstmt.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,null);
		}
		return rs;
	}
}
