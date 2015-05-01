package Model;

public class OnlineUserInfo {
	private int oid;
	private int uid;
	private int status;
	private int servTime;
	
	public OnlineUserInfo() {
		super();
	}

	public OnlineUserInfo(int oid, int uid, int status, int servTime) {
		super();
		this.oid = oid;
		this.uid = uid;
		this.status = status;
		this.servTime = servTime;
	}

	public int getOid() {
		return oid;
	}

	public void setOid(int oid) {
		this.oid = oid;
	}

	public int getUid() {
		return uid;
	}

	public void setUid(int uid) {
		this.uid = uid;
	}

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
		this.status = status;
	}

	public int getServTime() {
		return servTime;
	}

	public void setServTime(int servTime) {
		this.servTime = servTime;
	}
}
