package Model;

public class GroupInfo {
	private int gid;
	private String groupName;
	private int creTime;
	private int status;
	private int overTime;
	
	public GroupInfo() {
		super();
	}

	public GroupInfo(int gid, String groupName, int creTime, int status, int overTime) {
		super();
		this.gid = gid;
		this.groupName = groupName;
		this.creTime = creTime;
		this.status = status;
		this.overTime = overTime;
	}

	public int getGid() {
		return gid;
	}

	public void setGid(int gid) {
		this.gid = gid;
	}

	public String getGroupName() {
		return groupName;
	}

	public void setGroupName(String groupName) {
		this.groupName = groupName;
	}

	public int getCreTime() {
		return creTime;
	}

	public void setCreTime(int creTime) {
		this.creTime = creTime;
	}

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
		this.status = status;
	}

	public int getOverTime() {
		return overTime;
	}

	public void setOverTime(int overTime) {
		this.overTime = overTime;
	}
}
