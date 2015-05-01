package Model;

public class UserInfo {
	private int uid;
	private String telAccount;
	private String nationNo;
	private String password;
	private String userName;
	private int sex;
	private String email;
	private int creTime;
	private int status;
	private int gid;	
	private int role;
	
	public UserInfo(int uid, String telAccount, String nationNo, String password,String username, 
			int sex, String email, int creTime, int status,int gid,int role) {
		super();
		this.uid = uid;
		this.telAccount = telAccount;
		this.nationNo = nationNo;
		this.password = password;
		this.userName = username;
		this.sex = sex;
		this.email = email;
		this.creTime = creTime;
		this.status = status;
		this.gid = gid;
		this.role = role;
	}	
	
	public UserInfo() {
		super();
	}

	public int getUid() {
		return uid;
	}
	
	public void setUid(int uid) {
		this.uid = uid;
	}
	
	public String getTelAccount() {
		return telAccount;
	}
	
	public void setTelAccount(String telAccount) {
		this.telAccount = telAccount;
	}
	
	public String getNationNo() {
		return nationNo;
	}
	
	public void setNationNo(String nationNo) {
		this.nationNo = nationNo;
	}
	
	public String getPassword() {
		return password;
	}
	
	public void setPassword(String password) {
		this.password = password;
	}
	
	public String getUserName() {
		return userName;
	}
	
	public void setUserName(String userName) {
		this.userName = userName;
	}
	
	public int getSex() {
		return sex;
	}
	
	public void setSex(int sex) {
		this.sex = sex;
	}
	
	public String getEmail() {
		return email;
	}
	
	public void setEmail(String email) {
		this.email = email;
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
	
	public int getGid() {
		return gid;
	}

	public void setGid(int gid) {
		this.gid = gid;
	}

	public int getRole() {
		return role;
	}

	public void setRole(int role) {
		this.role = role;
	}	
}
