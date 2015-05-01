package Dao;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import Model.StateInfo;

public class StateInfoDao extends BaseDao {
	/*获取地理位置*/
	public List<StateInfo> getAllStateInfo(){
		List<StateInfo> list = new ArrayList<StateInfo>();
		Connection con = null;
		PreparedStatement pstmt = null;
		String sql = "select * from stateinfo";
		ResultSet rs = null;
		try {
			con = getCon();
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			while(rs.next()){
				int sid = rs.getInt("sid");
				int uid = rs.getInt("uid");
				double longitude = rs.getDouble("longitude");
				double latitude = rs.getDouble("latitude");
				int servTime = rs.getInt("servTime");			
				StateInfo stateInfo = new StateInfo(sid, uid,  longitude, latitude,servTime);
				list.add(stateInfo);
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{
			closeAll(con,pstmt,rs);
		}
		return list;
	}
	
	/*获取单条地理信息*/
	public StateInfo getOneStateInfo(int sid)
	{
		StateInfo stateInfo = null;
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;			
		try {
			con = getCon();
			String sql = "select * from stateinfo where sid="+sid;	
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			if(rs.next()){
				stateInfo = new StateInfo();
				stateInfo.setSid(rs.getInt("sid"));
				stateInfo.setUid(rs.getInt("uid"));
				stateInfo.setLatitude(rs.getDouble("longitude"));
				stateInfo.setLongitude(rs.getDouble("latitude"));
				stateInfo.setServTime(rs.getInt("servTime"));
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,rs);
		}
		return stateInfo;
	}
	
	/*获取单个用户的地理信息*/
	public StateInfo getOneStateInfo(int uid,int servTime)
	{
		StateInfo stateInfo = null;
		Connection con = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;			
		try {
			con = getCon();
			String sql = "select * from stateinfo where uid="+uid+" and servTime="+servTime;	
			pstmt = con.prepareStatement(sql);
			rs = pstmt.executeQuery();
			if(rs.next()){
				stateInfo = new StateInfo();
				stateInfo.setSid(rs.getInt("sid"));
				stateInfo.setUid(rs.getInt("uid"));
				stateInfo.setLatitude(rs.getDouble("longitude"));
				stateInfo.setLongitude(rs.getDouble("latitude"));
				stateInfo.setServTime(rs.getInt("servTime"));
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,rs);
		}
		return stateInfo;
	}

	/*插入地理信息*/
	public int InsertStateInfo(StateInfo stateInfo)
	{		
		Connection con = null;
		PreparedStatement pstmt = null;
		int rs = 0;
		try {
			con = getCon();
			String sql = "insert into stateinfo(uid,longitude,latitude,servTime) value(?,?,?,?)";	
			pstmt = con.prepareStatement(sql);
			pstmt.setInt(1, stateInfo.getUid());
			pstmt.setDouble(2, stateInfo.getLongitude());
			pstmt.setDouble(3, stateInfo.getLatitude());
			pstmt.setInt(4, stateInfo.getServTime());
			rs = pstmt.executeUpdate();
		} catch (Exception e) {
			e.printStackTrace();
		} finally{			
			closeAll(con,pstmt,null);
		}
		return rs;
	}
}
