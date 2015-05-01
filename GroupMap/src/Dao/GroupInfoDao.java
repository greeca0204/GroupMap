package Dao;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import Model.GroupInfo;

public class GroupInfoDao extends BaseDao {
	/*获取组的信息*/
	public List<GroupInfo> getAllGroupInfo(){
		List<GroupInfo> list = new ArrayList<GroupInfo>();
		Connection con = null;
		PreparedStatement pstmt = null;		
		String sql = "select * from groupinfo";
		ResultSet rs = null;
		try {
			con = getCon();
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			while(rs.next()){
				int gid = rs.getInt("gid");
				String groupName = rs.getString("groupName");
				int creTime = rs.getInt("creTime");	
				int status = rs.getInt("status");
				int overTime = rs.getInt("overTime");
				GroupInfo groupInfo = new GroupInfo(gid, groupName,  creTime, status,overTime);
				list.add(groupInfo);
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{
			closeAll(con,pstmt,rs);
		}
		return list;
	}
	
	/*获取指定一个组的信息*/
	public GroupInfo getOneGroupInfo(int gid)
	{
		GroupInfo groupInfo = null;
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;			
		try {
			con = getCon();
			String sql = "select * from groupinfo where gid="+gid;	
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			if(rs.next()){
				groupInfo = new GroupInfo();
				groupInfo.setGid(rs.getInt("gid"));
				groupInfo.setGroupName(rs.getString("groupName"));
				groupInfo.setCreTime(rs.getInt("creTime"));
				groupInfo.setStatus(rs.getInt("status"));
				groupInfo.setOverTime(rs.getInt("overTime"));
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,rs);
		}
		return groupInfo;
	}
	
	/*添加组信息*/
	public int InsertGroupInfo(GroupInfo groupInfo)
	{		
		Connection con = null;
		PreparedStatement pstmt = null;
		int rs = 0;
		try {
			con = getCon();
			String sql = "insert into groupinfo(groupName,creTime,status,overTime) value(?,?,?,?)";	
			pstmt = con.prepareStatement(sql);
			pstmt.setString(1, groupInfo.getGroupName());
			pstmt.setInt(2, groupInfo.getCreTime());
			pstmt.setInt(3, groupInfo.getStatus());
			pstmt.setInt(4, groupInfo.getOverTime());
			rs = pstmt.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,null);
		}
		return rs;
	}	
}
