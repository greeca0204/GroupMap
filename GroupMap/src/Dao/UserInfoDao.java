package Dao;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import Model.UserInfo;

public class UserInfoDao extends BaseDao {
	/*在数据库中获取用户信息表的所有用户信息*/
	public List<UserInfo> getAllUserInfo()
	{
		List<UserInfo> list = new ArrayList<UserInfo>();
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		try {
			con = getCon();
			String sql = "select * from userinfo";
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			while(rs.next()){
				int uid = rs.getInt("uid");
				String telAccount = rs.getString("telAccount");
				String nationNo = rs.getString("nationNo");
				String password = rs.getString("password");
				String userName = rs.getString("userName");
				int sex = rs.getInt("sex");
				String email = rs.getString("email");
				int creTime = rs.getInt("creTime");
				int status = rs.getInt("status");	
				int gid = rs.getInt("gid");
				int role = rs.getInt("role");
				UserInfo userinfo = new UserInfo(uid,telAccount,nationNo,password,userName,sex,email,creTime,status,gid,role);
				list.add(userinfo);
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{
			closeAll(con,pstmt,rs);
		}
		return list;
	}
	
	/*在数据库中获取单个用户的信息*/
	public UserInfo getOneUserInfo(int uid)
	{
		UserInfo userInfo = null;
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;			
		try {
			con = getCon();
			String sql = "select * from userinfo where uid="+uid;	
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			if(rs.next()){
				userInfo = new UserInfo();
				userInfo.setUid(rs.getInt("uid"));
				userInfo.setTelAccount(rs.getString("telAccount"));
				userInfo.setNationNo(rs.getString("nationNo"));
				userInfo.setPassword (rs.getString("password"));
				userInfo.setUserName(rs.getString("userName"));
				userInfo.setSex(rs.getInt("sex"));
				userInfo.setEmail(rs.getString("email"));
				userInfo.setCreTime(rs.getInt("creTime"));
				userInfo.setStatus(rs.getInt("status"));
				userInfo.setGid(rs.getInt("gid"));
				userInfo.setRole(rs.getInt("role"));
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,rs);
		}
		return userInfo;
	}
	
	/*插入用户基本信息*/
	public int InsertUserInfo(UserInfo userInfo)
	{		
		Connection con = null;
		PreparedStatement pstmt = null;
		int rs = 0;
		try {
			con = getCon();
			String sql = "insert into userinfo(telAccount,nationNo,password,username,sex,email,creTime,status,gid,role) value(?,?,?,?,?,?,?,?,?,?)";	
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, userInfo.getTelAccount());
			pstmt.setString(2, userInfo.getNationNo());
			pstmt.setString(3, userInfo.getPassword());
			pstmt.setString(4, userInfo.getUserName());
			pstmt.setInt(5, userInfo.getSex());
			pstmt.setString(6, userInfo.getEmail());
			pstmt.setInt(7, userInfo.getCreTime());
			pstmt.setInt(8, userInfo.getStatus());
			pstmt.setInt(9, userInfo.getGid());
			pstmt.setInt(10, userInfo.getRole());
			rs = pstmt.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,null);
		}
		return rs;
	}
}
