package Dao;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import Model.OnlineUserInfo;

public class OnlineUserInfoDao extends BaseDao {
	/*获取在线状态信息*/
	public List<OnlineUserInfo> getAllOnlineUserInfo(){
		List<OnlineUserInfo> list = new ArrayList<OnlineUserInfo>();
		Connection con = null;
		PreparedStatement pstmt = null;		
		String sql = "select * from onlineUserInfo";
		ResultSet rs = null;
		try {
			con = getCon();
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			while(rs.next()){
				int oid = rs.getInt("oid");
				int uid = rs.getInt("uid");
				int status = rs.getInt("status");
				int servTime = rs.getInt("servTime");
				OnlineUserInfo onlineUserInfo = new OnlineUserInfo(oid, uid, status, servTime);
				list.add(onlineUserInfo);
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{
			closeAll(con,pstmt,rs);
		}
		return list;
	}
	
	/*获取某条在线状态信息*/
	public OnlineUserInfo getOneOnlineUserInfo(int oid)
	{
		OnlineUserInfo onlineUserInfo = null;
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;			
		try {
			con = getCon();
			String sql = "select * from onlineUserInfo where oid="+oid;	
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			if(rs.next()){
				onlineUserInfo = new OnlineUserInfo();
				onlineUserInfo.setOid(rs.getInt("oid"));
				onlineUserInfo.setUid(rs.getInt("uid"));
				onlineUserInfo.setStatus(rs.getInt("status"));
				onlineUserInfo.setServTime(rs.getInt("servTime"));
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,rs);
		}
		return onlineUserInfo;
	}
	
	/*添加在线状态信息*/
	public int InsertOnlineUserInfo(OnlineUserInfo onlineUserInfo)
	{		
		Connection con = null;
		PreparedStatement pstmt = null;
		int rs = 0;
		try {
			con = getCon();
			String sql = "insert into groupinfo(uid,status,servTime) value(?,?,?)";	
			pstmt = con.prepareStatement(sql);
			pstmt.setInt(1, onlineUserInfo.getUid());
			pstmt.setInt(2, onlineUserInfo.getStatus());
			pstmt.setInt(3, onlineUserInfo.getServTime());
			rs = pstmt.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,null);
		}
		return rs;
	}	
}
