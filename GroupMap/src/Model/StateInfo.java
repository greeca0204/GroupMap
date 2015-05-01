package Model;

public class StateInfo {
	private int sid;
	private int uid;
	private double longitude;
	private double latitude;
	private int servTime;
	
	public StateInfo() {
		super();
	}

	public StateInfo(int sid, int uid, double longitude, double latitude, int servTime) {
		super();
		this.sid = sid;
		this.uid = uid;
		this.longitude = longitude;
		this.latitude = latitude;
		this.servTime = servTime;
	}

	public int getSid() {
		return sid;
	}

	public void setSid(int sid) {
		this.sid = sid;
	}

	public int getUid() {
		return uid;
	}

	public void setUid(int uid) {
		this.uid = uid;
	}

	public double getLongitude() {
		return longitude;
	}

	public void setLongitude(double longitude) {
		this.longitude = longitude;
	}

	public double getLatitude() {
		return latitude;
	}

	public void setLatitude(double latitude) {
		this.latitude = latitude;
	}

	public int getServTime() {
		return servTime;
	}

	public void setServTime(int servTime) {
		this.servTime = servTime;
	}
}
