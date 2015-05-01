package Model;

public class LogInfo {
	private int lid;
	private int uid;	
	private int time;
	private String action;
	private String data;
	
	public LogInfo() {
		super();
	}

	public LogInfo(int lid,int uid, int time, String action, String data) {
		super();
		this.lid = lid;
		this.uid = uid;
		this.time = time;
		this.action = action;
		this.data = data;
	}

	public int getLid() {
		return lid;
	}

	public void setLid(int lid) {
		this.lid = lid;
	}

	public int getUid() {
		return uid;
	}

	public void setUid(int uid) {
		this.uid = uid;
	}

	public int getTime() {
		return time;
	}

	public void setTime(int time) {
		this.time = time;
	}

	public String getAction() {
		return action;
	}

	public void setAction(String action) {
		this.action = action;
	}

	public String getData() {
		return data;
	}

	public void setData(String data) {
		this.data = data;
	}
}
